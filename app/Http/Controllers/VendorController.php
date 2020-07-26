<?php


namespace App\Http\Controllers;


use App\Http\Requests\VendorIndexRequest;
use App\Vendors;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{


    /**
     * @var Vendors
     */
    private $vendor;

    public function __construct(Log $log, Vendors $vendor)
    {
        parent::__construct($log);
        $this->vendor = $vendor;
    }

    /**
     * @param VendorIndexRequest $request
     * @return array
     */
    public function index(VendorIndexRequest $request)
    {
        try {
            $fields = $request->all();
            $vendors = $this->vendor->getList($fields, $this->readAvailableVendors());
            $message = [
                'success' => true,
                "code" => 200,
                "message" => 'OK',
                'data' => $vendors
            ];
        } catch (\Exception $ex) {
            $message = [
                'success' => false,
                'data ' => [],
                'code' => $ex->getCode(),
                'message' => "ERROR",
                'errors' => $ex->getMessage()
            ];
        }

        return $message;
    }

    private function readAvailableVendors()
    {
        $file = storage_path().'/models.json';
        return  json_decode(file_get_contents($file), true);
    }
}
