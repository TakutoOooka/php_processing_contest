<?php
include(PROJECT_ROOT . '/library/BaseController.php');
include(PROJECT_ROOT . '/models/ReviewModel.php');
class ReviewController extends BaseController
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->controller = 'review';
    }

    function show()
    {
        $this->render_view('show');
    }

    function new_action()
    {
        $this->render_view('new_action');
    }

    function create()
    {
        $review = new ReviewModel();
        $new_review = $review->new_record();
        $new_review['product_id'] = intval( $this->params['product_id'] );
        $new_review['user_id'] = intval( $this->params['user_id'] );
        $new_review['rating'] = intval( $this->params['rating'] );
        $new_review['review'] = $this->params['review'];
        $review->save($new_review);

        $this->render_view('create');
    }

    function edit()
    {
        $this->render_view('edit');
    }

    function update()
    {
        $this->render_view('update');
    }

    function delete()
    {
        $this->render_view('delete');
    }
}
