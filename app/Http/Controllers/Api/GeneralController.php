<?php

    namespace App\Http\Controllers\Api;
    use App\Http\Controllers\Controller;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    
    use Goutte\Client;
    use App\Lib\Scraper;

    use App\Models\General;

    class GeneralController extends Controller
    {
  
        public function general(){
            $scraper = new Scraper(new Client());
 
            $scraper->handle('https://www.covid19.gov.ao/');
            $data = General::orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->first()->setHidden(['id']);
         
            return response()->json([
                'success' => true,
                'message' => "Operação realizada com sucesso.", 
                'data' => $data,
                'status' => $scraper->status == 1? 1: 2,
                'license'   => 'This API was developed by Ravelino de Castro (https://github.com/ravelinodecastro) using official information from the government of angola (ministry of health) available at covid19.gov.ao'
            ]);
        }

        public function report(){
            $scraper = new Scraper(new Client());
 
            $scraper->handle('https://www.covid19.gov.ao/');
            $data = General::orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();
         
            return response()->json([
                'success' => true,
                'message' => "Operação realizada com sucesso.", 
                'data' => $data,
                'status' => $scraper->status == 1? 1: 2,
                'license'   => 'This API was developed by Ravelino de Castro (https://github.com/ravelinodecastro) using official information from the government of angola (ministry of health) available at covid19.gov.ao'
            ]);
        }
      
        
    }