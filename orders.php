<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $table = 'orders';
    public $timestamps = false;

    protected $fillable = ['nama_customers', 'nama_barang', 'jenis_barang', 'warna', 'tanggal_pesan', 'tanggal_datang', 'pembayaran', 'alamat', 'id_customers'];
}
