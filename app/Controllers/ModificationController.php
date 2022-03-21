<?php

namespace App\Controllers;
use App\Models\ModificationModel;

class ModificationController extends BaseController
{
    public function index($idcompetitor=1,$idride=1,$idschool=1,$idgokart=1,$idcompetition=1)
    {
        helper(['form']);
        
        if($this->request->getMethod() == 'post'){
            $rules = [
                'competitor_name' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Musisz wpisać imię.'],
                ],
                'competitor_surname' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Musisz wpisać nazwisko.'],
                ],
                // 'password' => 'required|min_length[8]',
                // 'category' => 'in_list[Student, Teacher]',
                // 'date' => [
                //     'rules' => 'required|check_date',
                //     'label' => 'Date',
                //     'errors' => [
                //         'check_date' => 'You need to specify a date before today'
                //     ]

                // ]
                
            ];
    
            if($this->validate($rules)){
                //return redirect() -> to('/form/success');
                //Then do database insertion
                //Login user
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }
        $session = \Config\Services::session();
        if(!isset($_SESSION["zalogowany"]))
        {
            $_SESSION["zalogowany"] = "";
        };
        if(!isset($_SESSION["status"]))
        {
            $_SESSION["status"] = "";
        };
        $data = [
            'meta_title' => 'Modyfikacja',
        ];
        if($_SESSION["zalogowany"] != "pełny")
            return view('gokartsMain',$data);

        $db = db_connect();
        $model = new ModificationModel($db);

        $data['competitordata']=$model->get('tm_zawodnik');
        $data['schooldata']=$model->get('szkola');
        $data['gokartdata']=$model->get('gokart');
        $data['competitiondata']=$model->get('zawody');
        $data['statusdata']=$model->get('status_przejazdu');
        $data['citydata']=$model->get('miasto');
        $data['ridedata']=$model->getride();

        $data['chosenschooldata']=$model->getchosen((int)$idschool,'szkola');
        $data['chosenridedata']=$model->getchosenride((int)$idride);
        $data['chosengokartdata']=$model->getchosen((int)$idgokart,'gokart');
        $data['chosencompetitiondata']=$model->getchosen((int)$idcompetition,'zawody');
        $data['chosencompetitordata']=$model->getchosen((int)$idcompetitor,'tm_zawodnik');              
    
        return view('modification',$data);   
    }

    public function modifycompetitor()
    {
        if(!($_SESSION["zalogowany"] == "pełny"))
            return redirect()->to( base_url().'/main');

        $db = db_connect();
        $model = new ModificationModel($db);
        $model->modifycompetitor($_POST['competitor_picker'],$_POST['competitor_name'],$_POST['competitor_surname'],$_POST['competitor_date'],$_POST['competitor_school'],$_POST['competitor_competition']);
        
        return redirect()->to( base_url().'/main/mod' );
    }

    public function modifyride()
    {
        if(!($_SESSION["zalogowany"] == "pełny"))
            return redirect()->to( base_url().'/main');

        $db = db_connect();
        $model = new ModificationModel($db);
        $time=(int)$_POST['minutes']*60000+(int)$_POST['seconds']*1000+(int)$_POST['miliseconds'];
        $model->modifyride($_POST['ride_picker'],$_POST['ride_status'],$_POST['ride_gokart'],$time);
        
        return redirect()->to( base_url().'/main/mod' );
    }

    public function modifyschool()
    {
        if(!($_SESSION["zalogowany"] == "pełny"))
            return redirect()->to( base_url().'/main');

        $db = db_connect();
        $model = new ModificationModel($db);
        $model->modifyschool($_POST['school_picker'],$_POST['school_name'],$_POST['school_town'],$_POST['school_acronym']);
        
        return redirect()->to( base_url().'/main/mod' );
    }

    public function modifygokart()
    {
        if(!($_SESSION["zalogowany"] == "pełny"))
            return redirect()->to( base_url().'/main');

        $db = db_connect();
        $model = new ModificationModel($db);
        $model->modifygokart($_POST['gokart_picker'],$_POST['gokart_name']);
        
        return redirect()->to( base_url().'/main/mod' );
        
    }

    public function modifycompetition()
    {
        if(!($_SESSION["zalogowany"] == "pełny"))
            return redirect()->to( base_url().'/main');

        $db = db_connect();
        $model = new ModificationModel($db);
        $model->modifycompetition($_POST['competition_picker'],$_POST['competition_name'],$_POST['competition_start_date'],$_POST['competition_end_date']);
        
        return redirect()->to( base_url().'/main/mod' );
        
    }
}