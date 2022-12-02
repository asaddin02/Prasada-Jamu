<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // untuk menampilkan halaman rekomendasi
        return view('jamu');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // untuk melakukan check rekomendasi jamu
        $keluhan = $request->keluhan;
        $d = new Rekomendasi($keluhan,$request->tahun);
        $data = [
            "nama" => $d->namaJamu(),
            "khasiat" => $d->khasiat(),
            "keluhan" => $keluhan,
            "umur" => $d->umur(),
            "saran" => $d->Saran(),
        ];
        return view('jamu',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

class Jamu{
    public function __construct($keluhan,$tahun)
    {
        $this->keluhan = $keluhan;
        $this->umur = $tahun;
    }

    public function umur()
    {
        return date("Y") - $this->umur;
    }

    public function namaJamu()
    {
        if($this->keluhan == "keseleo dan kurang nafsu makan"){
            return "Beras Kencur";
        } elseif($this->keluhan == "pegal-pegal"){
            return "Kunyit Asam";
        }  elseif($this->keluhan == "darah tinggi dan gula darah"){
            return "Brotowali";
        } elseif($this->keluhan == "kram perut dan masuk angin"){
            return "Temulawak";
        } elseif($this->keluhan == "keseleo"){
            return "Beras Kencur";
        } else {
            return "Gak Jual mas, maaf";
        }
    }

    public function khasiat()
    {
        if($this->namaJamu() == "Beras Kencur"){
            return "Mengurangi sakit karena keseleo dan mengatasi kurang nafsu makan";
        } elseif($this->namaJamu() == "Kunyit Asam"){
            return "Mengurasi rasa pegal-pegal";
        }  elseif($this->namaJamu() == "Brotowali"){
            return "Mengurangi tekanan darah tinggi dan gula darah";
        } elseif($this->namaJamu() == "Temulawak"){
            return "Mengobati kram perut dan masuk angin";
        } else {
            return "Yang laiin gaada mas";
        }
    }
}

class Rekomendasi extends Jamu{
    public function Saran()
    {
        if($this->keluhan == "keseleo"){
            return "Dioleskan";
        } else{
            if($this->umur() <= 10){
                return "Dikonsumsi 1x";
            } else{
                return "Dikonsumsi 2x";
            }
        }
    }
}
