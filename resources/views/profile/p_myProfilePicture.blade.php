@extends('layouts.privateProfile')
@section('content')

                    <!-- User profile picture. -->
                       <h3>Current Picture:</h3>
                            <br>
                            <form class="register-form" action="/updateProfilePicture">
                                <div class="form-group">
                                    <div id="container_photo" class="container_photo"></div>
                                    <label>Choose a New Image</label>
                                    <p class="help-block"><i class="fa fa-warning"></i> Image must be no larger than 500x500 pixels. Supported formats: JPG, GIF, PNG</p>

                                </div>
                                <input type="hidden" name="userID" value="{{ $users->id  }}" />
                                <div id="register-submit">
                                    <input type="submit" value="Update Profile Picture" />
                                </div>
                            </form>
            <script>
              $(document).ready(function() {
                 //Image crop start from here.
            $(".container_photo").PictureCut({
                InputOfImageDirectory       : "image",
                PluginFolderOnServer        : "/js/",
                FolderOnServer              : "/uploads/",
                EnableCrop                  : true,
                CropWindowStyle             : "Bootstrap"
            });

            prettyPrint();
              })
            </script>

@endsection