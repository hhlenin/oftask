<?php

use Illuminate\Support\Str;
static $imageDirectory;
static $image;

function imageUpload($user_image, $image_directory, $db_image = null) 
    {
        if(isset($user_image)) {
            if (!isset($db_image)) {
                $imageName = Str::random('10').'_'.time().'.'.$user_image->getClientOriginalExtension();
                $user_image->move($image_directory, $imageName);
                
                $imageURL = $image_directory.$imageName;
            }
            elseif(isset($db_image)){
                if (file_exists($db_image)){
                    unlink($db_image);
                }
                $imageName = Str::random('10').'_'.time().'.'.$user_image->getClientOriginalExtension();
                $user_image->move($image_directory, $imageName);
                $imageURL = $image_directory.$imageName;
            }
        }
        return $imageURL;
    } 
