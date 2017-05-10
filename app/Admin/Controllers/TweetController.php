<?php

namespace App\Admin\Controllers;

use App\Tweet;
use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class TweetController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('ツイート');
            $content->description('一覧');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('ツイート');
            $content->description('編集');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('ツイート');
            $content->description('作成');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Tweet::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->tweet();
            $grid->user()->nickname();
            $grid->active();
            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Tweet::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->select('user_id')->options(function ($id) {
                $user = User::find($id);
                if ($user) {
                    $user_list[$user->id] = $user->name;
                } else {
                    $users = User::all();
                    $user_list = [];
                    foreach ($users as $user)
                    {
                        $user_list[$user->id] = $user->name;
                    }
                }
                return $user_list;
            });
            $form->textarea('tweet');
            $form->switch('active');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
