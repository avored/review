<?php

namespace AvoRed\Review\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use AvoRed\Review\DataGrid\ProductReview;
use AvoRed\Review\Repository\Review;

class ReviewController extends Controller
{

    protected $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }


    public function index() {

        $bannerGrid = new ProductReview($this->review->model()->query());

        return view('avored-review::admin.review.index')->with('dataGrid', $bannerGrid->dataGrid);
    }


    public function approve($id) {


        $review = $this->review->findReviewById($id);

        $review->update(['status' => 'APPROVED']);

        return redirect()->route('admin.review.index');
    }

    public function update(BannerRequest $request, $id) {

        $banner = Banner::find($id);

        $image = $request->get('image');

        if(null != $image) {
            $dbPath = $this->_uploadBanner($image);
            $request->merge(['image_path' => $dbPath]);
        }

        $banner->update($request->all());

        return redirect()->route('admin.banner.index');
    }

    public function store(BannerRequest $request) {


        $image = $request->file('image');
        $dbPath = $this->_uploadBanner($image);

        $request->merge(['image_path' => $dbPath]);
        Banner::create($request->all());

        return redirect()->route('admin.banner.index');
    }

    public function destroy($id) {
        Banner::destroy($id);

        return redirect()->route('admin.banner.index');
    }

    private function _uploadBanner($image) {

        $tmpPath = str_split(strtolower(str_random(3)));
        $checkDirectory = '/uploads/cms/images/'.implode('/', $tmpPath);
        $dbPath = $checkDirectory.'/'.$image->getClientOriginalName();

        Image::upload($image, $checkDirectory);

        return $dbPath;

    }
}
