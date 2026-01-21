<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['client_id', 'invoice_number', 'issue_date', 'due_date', 'total_amount', 'status', 'notes'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
