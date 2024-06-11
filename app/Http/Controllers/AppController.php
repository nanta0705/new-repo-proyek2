<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard');
    }

    public function owner()
    {
        return view('owner.dashboard');
    }

    public function client()
    {
        return view('client.dashboard');
    }

    public function myfeature(Request $request)
    {
        $response = $request->session()->get('response');
        if($response){
            $decodedResponse = json_decode($response, true);

            // $decodedResponse = json_decode($response['response'], true);
    
            // Lakukan pengecekan kondisi berdasarkan nilai 'Warna Kulit'
            if ($decodedResponse && isset($decodedResponse['Warna Kulit']) && $decodedResponse['Warna Kulit']) {
                // Debug data jika kondisi terpenuhi;
                // buatkan 3 object didlamnya key value
                $message = "Berdasarkan hasil deteksi wajah, warna kulit anda terdeteksi sebagai: " 
                . $decodedResponse['Warna Kulit'].
                "\nDengan persentase: " 
                . $decodedResponse['Persentase'] . "%";
            // Tentukan rekomendasi gambar foundation berdasarkan warna kulit
                $foundationImages = $this->getFoundationImage($decodedResponse['Warna Kulit']);
                dd($foundationImages);

                return view('client.pages.skindetection', [
                    'message' => $message,
                    'foundationImage' => $foundationImages
                ]);
            }
        }
        
        return view('client.pages.skindetection');
    }

    private function getFoundationImage($warnaKulit)
    {
        // logika penentuan gambar foundation berdasarkan warna kulit
        $images = [
            'neutral' => ['neutral1.jpg', 'neutral2.jpg', 'neutral3.jpg', 'neutral4.jpg', 'neutral5.jpg'],
            'cool' => ['cool1.jpg', 'cool2.jpg', 'cool3.jpg', 'cool4.jpg', 'cool5.jpg'],
            'warm' => ['warm1.jpg', 'warm2.jpg', 'warm3.jpg', 'warm4.jpg', 'warm5.jpg'],

        ];
    
        return isset($images[$warnaKulit]) ? array_map(function($image) {
            return asset('assets/dataset/' . $image);
        }, $images[$warnaKulit]) : [];
    }

}
