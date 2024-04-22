@servers(['web' => 'root@192.168.245.131'])

@task('deploy',['on' => ['web'],'confirm'=>true])
    cd /var/www/laravel-blog-code
    git pull
@endtask