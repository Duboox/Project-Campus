<?php
    
    use Illuminate\Support\HtmlString;
    use Caffeinated\Shinobi\Models\Role;
    use App\User;

    /*======================
    =         User          =
    ========================*/
    
    if (!function_exists('user_avatar')) {
        /**
         * user_avatar
         * 
         * @return user avatar
         */
        function user_avatar()
        {
            $avatar = auth()->check() ? auth()->user()->avatar : null;

            return auth()->check() ? url_avatar($avatar) : null;
        }
    }

    if (!function_exists('username')) {
        /**
         * username
         * 
         * @return user name
         */
        function username()
        {
            return auth()->check() ? trim(auth()->user()->name) : 'null';
        }
    }


    if (!function_exists('id_user')) {
        /**
         * id_user
         * 
         * @return user name
         */
        function id_user()
        {
            return auth()->check() ? auth()->user()->id : null;
        }
    }

    if (!function_exists('user_level')) {
        /**
         * user_level
         * 
         * @param  
         * @return 
         */
        function user_level()
        {
            $role = User::with('roles')->find(id_user());

            if (auth()->check() && count($role->roles) > 0) {
                if (Shinobi::isRole($role->roles[0]->slug)) {
                    return $role->roles[0]->name;
                }
            }
            return 'Usuario';
        }
    }

   /*======================
    =      Dashboard       =
    ========================*/

    if (!function_exists('url_avatar')) {
        /**
         * url_avatar
         * 
         * @param  $file
         * @return path avatar
         */
        function url_avatar($file)
        {
            return url('images/avatars', $file);
        }
    }

    if (!function_exists('setActive')) {
        /**
         * setActive
         * 
         * @param  $path
         * @return html class 
         */
        function setActive($path)
        {
            return Request::is('dashboard/'.$path) ? 'class = active' : null;
        }
    }

    if (!function_exists('path_app')) {
        /**
         * path_app
         * 
         * @param  $path, $file, $data
         * @return path of dashboard/app
         */
         
        function path_app($path, $file, $data)
        {
            return view("dashboard/app/{$path}/{$file}", compact('data'));
        }
    }

    if (!function_exists('save_response')) {
        /**
         * save_response
         * 
         * @param  $response, $route, $position, $message
         * @return response to html
         */
        function save_response($response, $route, $message)
        {
            if ($response) {
                return redirect()->route($route)->with(
                    'success', $message
                );
            }else{
                return redirect()->route($route)->with(
                    'error', $message
                );
            }
        }
    }

   if (!function_exists('empty_field')) {
        /**
         * empty_field
         * 
         * @param  $var, $option
         * @return response if it is empty or not
         */
        function empty_field($var, $option = null, $name = null)
        {
            if ($option == 'textarea') {
                if (empty($var)) {
                     return new HtmlString('
                        <textarea name="'.$name.'" class="form-control" placeholder="El campo está vacio"></textarea>'
                    );
                }else{
                     return new HtmlString(
                        '<textarea name="'.$name.'" class="form-control">'.$var.'</textarea>'
                    );
                }
            }else{
                if (empty($var)) {
                    return new HtmlString('
                        <span class="empty_else">El campo está vacio</span>'
                    );
                }else{
                    return $var;
                }
            }
        }
    }

    if (!function_exists('url_img')) {
        /**
         * url_img
         * 
         * @param  $path, $file
         * @return url for images
         */
        function url_img($path, $file)
        {
            return url('images', [$path, $file]);
        }
    }

    if (!function_exists('url_tmpl')) {
        /**
         * url_tmpl
         * 
         * @param  $file
         * @return link with path css
         */
        function url_tmpl($path_type, $path, $file)
        {   
            return url("tmpl_dashboard/{$path_type}/plugins", [$path, $file]);
        }
    }

    if (!function_exists('css')) {
        /**
         * css
         * 
         * @param  $file
         * @return link css
         */
        function css($file)
        {   
            return Html::style("tmpl_dashboard/css/{$file}.css");
        }
    }

    if (!function_exists('css_plugin')) {
        /**
         * css_plugin
         * 
         * @param  $path, $file
         * @return link css
         */
        function css_plugin($path, $file)
        {
            return Html::style( url_tmpl('css', $path, $file.'.css') );
        }
    }

    if (!function_exists('js')) {
        /**
         * js
         * 
         * @param  $file
         * @return link js
         */
        function js($file)
        {   
            return Html::script("tmpl_dashboard/js/{$file}.js");
        }
    }

    if (!function_exists('js_plugin')) {
        /**
         * js_plugin
         * 
         * @param  $file
         * @return link with path js
         */
        function js_plugin($path, $file)
        {
            return Html::script( url_tmpl('js', $path, $file.'.js') );
        }
    }
    
    if (!function_exists('fullname')) {
        /**
         * fullname
         * 
         * @param  $names, $last_names
         * @return full name
         */
        function fullname($names, $last_names)
        {
            return "{$names} {$last_names}";
        }
    }



    


    



