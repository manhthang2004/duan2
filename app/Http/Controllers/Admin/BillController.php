<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\Bill;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::withCount('otherBills')->get();
        return view('admin.bills.index', compact('bills'));
    }

    /**
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Bill::with(['otherBills.product' => function ($query) {
            $query->select('id', 'pro_name', 'brand_id');
        }, 'voucher'])->findOrFail($id);
    
        return view('admin.bills.show', compact('bill'));
    }
    

    /**
     * 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $bill = Bill::findOrFail($id);

        if ($bill->id_status == 1) {
            $bill->id_status = 2;
            $bill->save();

            return redirect()->route('admin.bills.index')->with('success', 'Đơn hàng đã được xác nhận');
        }

        return redirect()->route('admin.bills.index')->with('error', 'Đơn hàng không thể xác nhận');
    }
    public function generatePDF($id)
    {
        $bill = Bill::with(['otherBills.product.brand'])->findOrFail($id);

        $pdf = Pdf::loadView('admin.bills.pdf', compact('bill'));

        return $pdf->download('bill-' . $bill->id . '.pdf');
    }


    public function sendInvoice($id)
    {
       
     // Lấy hóa đơn cùng với dữ liệu liên quan
     $bill = Bill::with(['otherBills.product' => function ($query) {
        $query->select('id', 'pro_name', 'brand_id');
    }, 'voucher', 'user'])->findOrFail($id);

    // Kiểm tra nếu hóa đơn và email của người dùng hợp lệ
    if (!$bill || !$bill->user || !$bill->user->email) {
        return redirect()->back()->with('error', 'Thông tin hóa đơn hoặc email không hợp lệ.');
    }

    $userEmail = $bill->user->email;

    // Gửi email
    Mail::to($userEmail)->send(new InvoiceMail($bill));

    return redirect()->back()->with('success', 'Email hóa đơn đã được gửi!');
    
    }

    public function destroy($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->delete();

        return redirect()->route('admin.bills.index')->with('success', 'Đơn hàng đã được xóa');
    }
}
