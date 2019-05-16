# config valid only for current version of Capistrano
#lock '3.4.0'

# Log level
set :log_level, :debug

set :application, 'region-resolver'
set :repo_url, 'git@bitbucket.org:amicus-studio/region-resolver.git'
set :scm, :git # Default value for :scm is :git

# Default branch is :master
# ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp

# Default value for :pty is false
# set :pty, true

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Public path
set :web_path,              "public"

# Symfony var path
set :var_path,              "var"

# Symfony bin path
set :bin_path,              "bin"

# Symfony log path
set :log_path,               "#{fetch(:var_path)}/log"

# Symfony cache path
set :cache_path,            "#{fetch(:var_path)}/cache"

# Symfony console path
set :symfony_console_path,  "#{fetch(:bin_path)}/console"

# Default value for :linked_files is []
set :linked_files,        ["config/parameters.yaml"]

# Default value for linked_dirs is []
set :linked_dirs,         [fetch(:log_path)]

# Dirs that need to be writable by the HTTP Server (i.e. cache, log dirs)
set :file_permissions_paths, [fetch(:log_path), fetch(:cache_path)]

# Execute set permissions
set :use_set_permissions,   true

before  'deploy',                       'assets:build'
#before  'deploy:published',             'assets:upload'
#before  'assets:locally:gulp_build',    'assets:locally:symfony:fos_js_routing_dump'
#before  'assets:locally:gulp_build',    'assets:locally:symfony:bazinga_js_translation_dump'

#after   'deploy:published',             'database:migrate'
#after   'deploy:published',             'symfony:cache_accelerator_clear'
#after   'deploy:published',             'ckeditor:install' # Installed via composer script
#after   'deploy:published',             'ckfinder:download' # Installed via composer script