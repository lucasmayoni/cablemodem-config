<?php


namespace App\Http\Controllers;


use App\Http\Requests\CableModemIndexRequest;
use App\CableModem;
use App\Http\Requests\CableModemRequest;
use Illuminate\Support\Facades\Log;

class CableModemController extends Controller
{


    /**
     * @var CableModem
     */
    private $vendor;

    public function __construct(Log $log, CableModem $vendor)
    {
        parent::__construct($log);
        $this->vendor = $vendor;
    }

    /**
     * @param CableModemIndexRequest $request
     * @return array
     */
    public function index(CableModemIndexRequest $request)
    {
        try {
            $fields = $request->all();
            Log::info(__METHOD__. " Reading data :", compact('fields'));

            $modems = $this->vendor->getList($fields, $this->arrayModels());

            $message = [
                'success' => true,
                "code" => 200,
                "message" => 'OK',
                'data' => $modems
            ];
        } catch (\Exception $ex) {
            $message = [
                'success' => false,
                'data ' => [],
                'code' => $ex->getCode(),
                'message' => "ERROR",
                'errors' => $ex->getMessage()
            ];
            Log::error(__METHOD__. " Exception: ", compact('message'));
        }

        return $message;
    }


    public function store(CableModemRequest $request)
    {
        $fields = $request->all();
        try {
            Log::info(__METHOD__. " Storing new info in JSON file :", compact('fields'));
            $file = storage_path().'/models.json';
            $data = json_decode(file_get_contents($file), true);
            array_push($data['models'],[
                'vendor' => $fields['vendor'],
                'name' => $fields['name'],
                'soft' => $fields['version'],
            ]);
            file_put_contents($file, json_encode($data));

            $message = [
                'success' => true,
                "code" => 200,
                "message" => 'OK',
            ];
        } catch (\Exception $ex) {
            $message = [
                'success' => false,
                'data ' => [],
                'code' => $ex->getCode(),
                'message' => "ERROR",
                'errors' => $ex->getMessage()
            ];
            Log::error(__METHOD__. " Exception: ", compact('message'));

        }
        return $message;
    }

    /**
     * @return array
     */
    private function arrayModels()
    {
        $file = storage_path().'/models.json';
        $data = json_decode(file_get_contents($file), true);
        return array_unique(array_column($data['models'],'name'));
    }
}
