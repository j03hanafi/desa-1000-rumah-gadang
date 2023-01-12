<?php

namespace App\Controllers\Web;

use App\Models\GalleryUniquePlaceModel;
use App\Models\ReviewModel;
use App\Models\UniquePlaceModel;
use CodeIgniter\RESTful\ResourcePresenter;

class UniquePlace extends ResourcePresenter
{
    protected $uniquePlaceModel;
    protected $uniquePlaceGalleryModel;
    protected $reviewModel;
    protected $helpers = ['auth', 'url', 'filesystem'];

    public function __construct()
    {
        $this->uniquePlaceModel = new UniquePlaceModel();
        $this->uniquePlaceGalleryModel = new GalleryUniquePlaceModel();
        $this->reviewModel = new ReviewModel();
    }

    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $contents = $this->uniquePlaceModel->get_list_up_api()->getResultArray();
        $data = [
            'title' => 'Unique Place',
            'data' => $contents,
        ];

        return view('web/list_unique_place', $data);
    }

    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $uniquePlace = $this->uniquePlaceModel->get_up_by_id_api($id)->getRowArray();
        if (empty($uniquePlace)) {
            return redirect()->to(substr(current_url(), 0, -strlen($id)));
        }

        $avg_rating = $this->reviewModel->get_rating('id_unique_place', $id)->getRowArray()['avg_rating'];
        $list_review = $this->reviewModel->get_review_object_api('id_unique_place', $id)->getResultArray();

        $list_gallery = $this->uniquePlaceGalleryModel->get_gallery_api($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }


        $uniquePlace['avg_rating'] = $avg_rating;
        $uniquePlace['reviews'] = $list_review;
        $uniquePlace['gallery'] = $galleries;

        $data = [
            'title' => $uniquePlace['name'],
            'data' => $uniquePlace,
        ];

        if (url_is('*dashboard*')) {
            return view('dashboard/detail_unique_place', $data);
        }
        return view('web/detail_unique_place', $data);
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id = null)
    {
        //
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
