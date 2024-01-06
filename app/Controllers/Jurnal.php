<?php

namespace App\Controllers;

use Config\Services;
use App\Controllers\BaseController;

class Jurnal extends BaseController
{
    protected $jurnalModel;
    protected $setting;
    protected $user;
    public function __construct()
    {
        $this->jurnalModel = new \App\Models\JurnalModel();
        $this->db = db_connect();
        $this->setting = $this->db->table('setting')->get()->getRow();
        $this->user = $this->db->query("SELECT * FROM user WHERE id = '7'")->getRow();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Jurnal : Home',
            'brandName' => $this->setting->brand_name,
            'role' => $this->user->role,
            'warehouse' => 'BANDUNG 3',
            'jurnal' => $this->jurnalModel->getAccountTrace(),
        ];

        return view('jurnal/index', $data);
    }

    public function addJournal()
    {
        $builder = $this->db->table('acc_coa');
        $query = $builder->get();
        $akun = $query->getResult();
        $data = [
            'title' => 'Jurnal : Add Jurnal',
            'brandName' => $this->setting->brand_name,
            'role' => $this->user->role,
            'warehouse' => 'BANDUNG 3',
            'akun' => $akun,
            'validation' => Services::validation()
        ];
        return view('jurnal/addJurnal', $data);
    }

    public function save()
    {
        // Load the validation library in your controller if not already loaded
        $validation = \Config\Services::validation();

        // Set validation rules
        $rules = [
            'waktu' => 'required',
            'description' => 'required|max_length[160]|min_length[5]',
            'debt_code' => 'required',
            'cred_code' => 'required',
            'amount' => 'required|numeric'
        ];

        // Set validation rules
        $validation->setRules($rules);

        // Run validation
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/jurnal/addJournal')->withInput()->with('validation', $validation);
        }
        // Validation passed, continue processing the data


        $this->jurnalModel->save(
            [
                'waktu' => $this->request->getVar('waktu'),
                'invoice' => $this->jurnalModel->invoice_journal(),
                'description' => $this->request->getVar('description'),
                'debt_code' => $this->request->getVar('debt_code'),
                'cred_code' => $this->request->getVar('cred_code'),
                'jumlah' => $this->request->getVar('amount'),
                'status' => 1,
                'rvpy' => null,
                'pay_stats' => null,
                'pay_nth' => null,
                'user_id' => 7,
                'wh_id' => 1
            ]
        );

        return redirect()->to('/jurnal');

        // dd($this->request->getVar());
    }
}
