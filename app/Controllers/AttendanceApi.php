<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class AttendanceApi extends ResourceController
{
    protected $modelName = 'App\Models\AttendanceModel';
    protected $format    = 'json';

    // public function index()
    // {
    //     $data = $this->model->showAll();

    //     if ($data || $data == []) {
    //         $respond['data'] = $data;
    //         $respond['status'] = 'success';
    //         return $this->respond($respond);
    //     }
    // }


    public function create() // saya hadir
    {
        if (!$this->validate('hadir')) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getVar();
        if ($this->model->findData($data['id_events'], $data['id_people'])) {
            return $this->failValidationErrors('Anda sudah hadir');
        }

        if ($this->model->insert($data)) {
            $respond['data'] = $data;
            $respond['status'] = 'success';
            $respond['message'] = 'Data berhasil ditambahkan';
            return $this->respondCreated($respond, $respond['message']);
        }
    }


    public function update($id = null)
    {
        // Check id
        if (!$this->model->find($id)) {
            return $this->failNotFound('id ' . $id . ' tidak ditemukan');
        }
        // Validation
        if (!$this->validate('hadir')) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // Data
        $data = $this->request->getRawInput();
        $data['id'] = $id;
        if ($this->model->update($id, $data)) {
            $respond['data'] = $data;
            $respond['status'] = 'success';
            $respond['message'] = 'Data berhasil diubah';
            return $this->respondUpdated($respond, $respond['message']);
        }
    }


    public function delete($idEvents = null, $idPeople = null)
    {
        $data = $this->model->findData($idEvents, $idPeople);
        $idAttendance = $data[0]['id'];
        if (!$idAttendance) {
            return $this->failNotFound('id tidak ditemukan');
        }
        if ($this->model->delete($idAttendance)) {
            $respond['status'] = 'success';
            $respond['message'] = 'Data berhasil dihapus';
            return $this->respondDeleted([$respond, $respond['message']]);
        }
    }



    public function showPeopleByEvents($id = null) // info kehadiran per event
    {
        $data = $this->model->findPeopleByEventsId($id);

        // foreach ($data as $d => $value) {
        //     $value['hadir_pada'] = date('Y-m-d H:i:s', strtotime($value['hadir_pada']));
        //     echo $value['hadir_pada'];
        // }
        if ($data) {
            $respond['data'] = $data;
            $respond['status'] = 'success';
            return $this->respond($respond);
        }
        return $this->failNotFound('No data');
    }

    public function showEventsByPeople($id = null) // info kehadiran per event
    {
        $data = $this->model->findEventsByPeopleId($id);

        if ($data) {
            $respond['data'] = $data;
            $respond['status'] = 'success';
            return $this->respond($respond);
        }
        return $this->failNotFound('id ' . $id . ' tidak ditemukan');
    }
}
