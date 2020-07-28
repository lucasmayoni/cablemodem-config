<?php


namespace Tests\Integration;


use App\CableModem;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CableModemTest extends TestCase
{
    use DatabaseTransactions;

    protected $connectionsToTransact = ['mysql'];

    /**
     * @test
     * @testdox Query should return 1 record only; unique model not present in jsonFile
     */
    public function caseOne()
    {

        $model = resolve(CableModem::class);
        $model->where('modem_macaddr','!=','')->update([
            'vsi_model' => 'DG1555'
        ]);
        $modem = factory(CableModem::class)->create([
            'vsi_model' => 'TESTMODEL'
        ]);

        $data = $model->getList('',$this->mockJsonFile());
        $this->assertEquals(1, $data->count());
    }
    /**
     * @test
     * @testdox Query should return 0 records; model is present in json file
     */
    public function caseTwo()
    {
        $model = resolve(CableModem::class);
        $model->where('modem_macaddr','!=','')->update([
            'vsi_model' => 'DG1555'
        ]);
        $modem = factory(CableModem::class)->create([
            'vsi_model' => 'SBG900'
        ]);

        $data = $model->getList('',$this->mockJsonFile());
        $this->assertEquals(0, $data->count());
    }

    private function mockJsonFile()
    {
        return [
            'DPC3825',
            'DPC9989',
            'SBG901',
            'DPC2320',
            'DG860P2',
            'SBG900',
            'DG950A',
            'DG950A',
            'TG862A',
            'DG860P2_v9',
            'DG860P2',
            'DPC2320',
            'DG1660A',
            'DG1555',
            'DG1660A_v9'
        ];
    }
}
