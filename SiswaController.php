<?php
public function update($id, Request $request)
 {
    $validator=Validator::make($request->all(),
        [
            'nama_siswa' => 'required',
            'tanggal_lahir' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'id_kelas' => 'required'
        ]
    );
        if($validator->fails()) {
        return Response()->json($validator->errors());
    }
        $ubah = Siswa::where('id', $id)->update([
            'nama_siswa' => $request->nama_siswa,
            'tanggal_lahir' => $request->tanggal_lahir,
            'gender' => $request->gender,
            'alamat' => $request->alamat,
            'id_kelas' => $request->id_kelas
    ]);
        if($ubah) {
        return Response()->json(['status' => 1]);
    }
    else {
        return Response()->json(['status' => 0]);
    }
    }
        public function destroy($id)
    {
        $hapus = Siswa::where('id', $id)->delete();
        if($hapus) {
        return Response()->json(['status' => 1]);
    }
        else {
        return Response()->json(['status' => 0]);
    }
 }
