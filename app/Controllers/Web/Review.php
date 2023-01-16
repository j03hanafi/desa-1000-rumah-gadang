<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\ReviewModel;
use CodeIgniter\I18n\Time;

class Review extends BaseController
{
    protected $reviewModel;
    public function __construct()
    {
        $this->reviewModel = new ReviewModel();
    }
    
    public function add()
    {
        $request = $this->request->getPost();
        $requestData = [
            'id_comment' => $this->reviewModel->get_new_id_api(),
            'comment' => $request['comment'],
            'date' => Time::now(),
            'rating' => $request['rating'],
            'id_user' => user()->id,
        ];
        if (substr($request['object_id'], 0, 1) == 'R') {
            $requestData['id_rumah_gadang'] = $request['object_id'];
            $addReview = $this->reviewModel->add_review_api($requestData);
            if ($addReview) {
                return redirect()->to(base_url('web/rumahGadang') . '/' . $requestData['id_rumah_gadang'] . '#reviews');
            }
        }

        if (substr($request['object_id'], 0, 1) == 'E') {
            $requestData['id_event'] = $request['object_id'];
            $addReview = $this->reviewModel->add_review_api($requestData);
            if ($addReview) {
                return redirect()->to(base_url('web/event') . '/' . $requestData['id_event'] . '#reviews');
            }
        }

        if (substr($request['object_id'], 0, 1) == 'E') {
            $requestData['id_unique_place'] = $request['object_id'];
            $addReview = $this->reviewModel->add_review_api($requestData);
            if ($addReview) {
                return redirect()->to(base_url('web/uniquePlace') . '/' . $requestData['id_unique_place'] . '#reviews');
            }
        }

        return redirect()->to(base_url('web'));
    }
}
