<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalModel extends Model
{
    protected $table = 'account_trace';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'invoice',
        'description',
        'debt_code',
        'cred_code',
        'waktu',
        'jumlah',
        'status',
        'rvpy',
        'pay_stats',
        'pay_nth',
        'user_id',
        'wh_id'
    ];

    protected $timestamps = true;

    public function invoice_journal()
    {
        // $uname = $this->session->userdata('uname');
        $sql = "SELECT * FROM user WHERE id = 7";
        // $data['tanggal'] = date('Y-m-d');
        $user = $this->db->query($sql)->getRow();
        $user_id = $user->id;

        $lastInvoice = $this->query("SELECT MAX(RIGHT(invoice,7)) AS kd_max FROM account_trace
        WHERE user_id = '$user_id'")->getRow();
        if ($lastInvoice) {
            // Extract the numeric part of the last invoice number and increment it
            $lastNumber = intval(preg_replace('/[^0-9]+/', '', $lastInvoice->kd_max));
            $newNumber = $lastNumber + 1;
        } else {
            // If no invoices exist yet, start with a default number, like 'INV-1000'
            $newNumber = 0000001;
        }

        // Generate the new invoice number with a prefix
        $newInvoiceNumber = 'JR.BK.' . date('dmy') . '.' . $user_id . '.' . sprintf("%07s", $newNumber);

        // // Save the new invoice number to the database
        // $this->insert(['invoice_number' => $newInvoiceNumber]);

        return $newInvoiceNumber;
    }

    public function getAccountTrace($start_date = null, $end_date = null)
    {
        if ($start_date === null) {
            $start_date = date('Y-m-d');
        }

        if ($end_date === null) {
            $end_date = date('Y-m-d');
        }

        $builder = $this->db->table('account_trace');
        $builder->select('account_trace.*, acc_coa.acc_name AS debt_acc_name, a.acc_name AS cred_acc_name');
        $builder->where("date(waktu) BETWEEN '$start_date' and '$end_date'", null, false);
        $builder->orderBy('waktu', 'DESC');
        $builder->join('acc_coa', 'account_trace.debt_code = acc_coa.acc_code');
        $builder->join('acc_coa as a', 'account_trace.cred_code = a.acc_code');
        $query = $builder->get();

        return $query->getResult();
    }
}
