<?php

use Illuminate\Database\Seeder;
use App\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 10;

        for ($i = 0; $i < $count; $i++) {
            $project = new Project;
            $project->name = 'Hoa văn đại việt '.$i;
            $project->aim_money = 1000000000;
            $project->summary = 'Hoa văn Đại Việt (với tiêu đề Sách tô màu cho người lớn) là nhan đề một đồ án "vector hóa"[1] các họa tiết trang trí cổ truyền Việt Nam, do nhóm Đại Việt Cổ Phong khởi xướng và thực hiện trong thời kỳ 2015-7.';
            $project->content = 'Hoa văn Đại Việt (với tiêu đề Sách tô màu cho người lớn) là nhan đề một đồ án "vector hóa"[1] các họa tiết trang trí cổ truyền Việt Nam, do nhóm Đại Việt Cổ Phong khởi xướng và thực hiện trong thời kỳ 2015-7.';
            $project->thumbnail = 'http://homestead.test/images/default.jpg';
            $project->user_id = 1;
            $project->save();
        }
    }
}
