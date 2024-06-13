<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class DiagnosaController extends Controller
{
    public function sendFile(Request $request) {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => "Invalid request."], 400);
        }

        $file = $request->file('file');
        $tmpFileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $tmpFilePath = $file->storeAs('tmp', $tmpFileName); // Store Ke Temp

        $remoteUrl = 'http://10.0.175.162:8000/uploadgambar/';
        $postData = [
            'file' => new \CURLFile(storage_path('app/' . $tmpFilePath), $file->getClientMimeType(), $file->getClientOriginalName()),
        ];

        $response = $this->sendFileToRemoteServer($remoteUrl, $postData);

        Storage::delete($tmpFilePath); //Delete Setelah Deteksi Selanjutnya

        if ($response['httpCode'] == 200) {
            return redirect()->route('skindetection')->with('response', $response['response']);//permintaan pengiriman file ke server remote berhasil 
        } else {
            return back()->withErrors(['error' => $response['error']]);
        }
    }

    private function sendFileToRemoteServer($remoteUrl, $postData) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $remoteUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            return ['httpCode' => 0, 'response' => null, 'error' => "cURL error: " . $error];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            'httpCode' => $httpCode,
            'response' => $response,
            'error' => ($httpCode != 200) ? "Remote Gagal" . $httpCode : null,
        ];
    }

    public function runMain() {
        $remoteUrl = 'http://127.0.0.1:8000/run-main/';
        $response = Http::get($remoteUrl);

        if ($response->successful()) {
            return response()->json(['message' => $response->json()], 200);
        } else {
            return response()->json(['error' => 'Failed to run main program.'], 500);
        }
    }
}
