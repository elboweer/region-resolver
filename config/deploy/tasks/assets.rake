namespace :assets do

  namespace :locally do

    desc 'composer install'
    task :composer_install do
      run_locally do
        execute "composer install --no-interaction --optimize-autoloader"
      end
    end

    namespace :symfony do
      task :cache_clear do
        symfony_console_path = fetch(:symfony_console_path)
        symfony_console_flags = fetch(:symfony_console_flags)
        symfony_env = fetch(:symfony_env)

        run_locally do
          execute "#{symfony_console_path} cache:clear #{symfony_console_flags} --env=#{symfony_env} --no-warmup"
        end
      end

    end
  end

#  task :upload do
#    release_path = fetch(:release_path)
#    web_path = fetch(:web_path)
#
#    on roles(:web) do
#        execute :mkdir, "-pv", "#{release_path}/#{web_path}/build"
#        upload! "#{web_path}/build", "#{release_path}/#{web_path}", :recursive => true
#    end
#  end

  task :build do
    invoke 'assets:locally:composer_install'
#    invoke 'assets:locally:npm_install'
    invoke 'assets:locally:symfony:cache_clear'
#    invoke 'assets:locally:gulp_build'
#    invoke 'assets:locally:webpack_build'
  end

end