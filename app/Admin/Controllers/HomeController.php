<?php

namespace App\Admin\Controllers;

use App\User;
use App\Tweet;

use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Chart\Bar;
use Encore\Admin\Widgets\Chart\Doughnut;
use Encore\Admin\Widgets\Chart\Line;
use Encore\Admin\Widgets\Chart\Pie;
use Encore\Admin\Widgets\Chart\PolarArea;
use Encore\Admin\Widgets\Chart\Radar;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('ダッシュボード');
            // $content->description('Description...');

            $content->row(function ($row) {
                $row->column(6, new InfoBox('ツイート', 'twitter', 'aqua', '/admin/tweets', Tweet::all()->count()));
                $row->column(6, new InfoBox('ユーザー', 'users', 'orange', '/admin/users', User::all()->count()));
            });

            $tweets = Tweet::where('active', 1)->orderBy('updated_at', 'desc')->get();
            foreach ($tweets as $tweet) {
                $rows[] = [$tweet->user->nickname . ' @' . $tweet->user->name, $tweet->tweet, $tweet->getDiffForHumans()];
            }

            $headers = ['Name', 'Tweet', ''];

            $content->row((new Box('タイムライン', new Table($headers, $rows)))->style('info')->solid());
        });
    }
}
