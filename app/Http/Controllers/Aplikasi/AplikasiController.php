<?php
namespace App\Http\Controllers\Aplikasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class AplikasiController extends Controller
{
    protected $firebaseStorage;
    protected $realtimeDatabase;

    public function __construct()
    {
        $this->firebaseStorage = Firebase::storage();
        $this->realtimeDatabase = Firebase::database();
    }

    public function index()
    {
        // Fetch all files from Realtime Database
        $files = $this->realtimeDatabase->getReference('aplikasi_files')->getValue();

        // Pass the files to the view
        return view('pages.upload_aplikasi.index', ['files' => $files]);
    }

    public function uploadFile(Request $request)
    {
        $uid = $request->session()->get('uid');

        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,zip,rar,apk', // Allow APK files
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'aplikasi_files/' . $fileName;

            // Upload the file to Firebase Storage
            $uploadedFile = fopen($file->getPathname(), 'r');
            $this->firebaseStorage->getBucket()->upload($uploadedFile, [
                'name' => $filePath
            ]);

            // Get the signed URL of the uploaded file
            $storageUrl = $this->firebaseStorage->getBucket()->object($filePath)->signedUrl(new \DateTime('+100 years'));

            // Save the file details to Realtime Database
            $postData = [
                'file_name' => $fileName,
                'file_path' => $storageUrl,
                'uploaded_by' => $uid,
                'uploaded_at' => now()->toDateTimeString(),
            ];

            $this->realtimeDatabase->getReference('aplikasi_files')->push($postData);

            return redirect()->back()->with('success', 'File uploaded successfully');
        }

        return redirect()->back()->with('error', 'File upload failed');
    }

    public function deleteFile(Request $request)
    {
        // Validate the file ID
        $request->validate([
            'file_id' => 'required|string',
        ]);

        $fileId = $request->input('file_id');

        // Get the file reference from Realtime Database
        $fileReference = $this->realtimeDatabase->getReference('aplikasi_files')->getChild($fileId);
        $fileData = $fileReference->getValue();

        if ($fileData) {
            // Remove the file reference from Realtime Database
            $fileReference->remove();

            return redirect()->back()->with('success', 'File reference deleted successfully. The file remains in Firebase Storage.');
        }

        return redirect()->back()->with('error', 'File reference not found.');
    }

    public function downloadApp()
    {
        // Ambil data dari node aplikasi_files di Firebase Realtime Database
        $applications = $this->realtimeDatabase->getReference('aplikasi_files')->getValue();

        // Ambil file yang terakhir di-upload
        if ($applications) {
            $latestFile = collect($applications)->sortByDesc('uploaded_at')->first();

            // Redirect ke URL file untuk mengunduhnya
            return redirect()->away($latestFile['file_path']);
        }

        return redirect()->back()->with('error', 'File aplikasi tidak ditemukan.');
    }
}
