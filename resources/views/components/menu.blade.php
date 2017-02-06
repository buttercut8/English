<info-user></info-user>
<div class="info_menu collection">
        @if(auth()->user()->id == 1)
            <router-link to="/add-member" exact class="collection-item waves-effect waves_colors">
                   <span class="title">Add Member</span>
                   <i class="material-icons secondary-content">person_add</i>
            </router-link>
        @endif
        <router-link to="/todo-list" exact class="collection-item waves-effect waves_colors">
               <span class="title">Todo List</span>
               <i class="material-icons secondary-content">aspect_ratio</i>
               <span class="new badge">4</span>
        </router-link>
        <router-link to="/firebase" exact class="collection-item waves-effect waves_colors">
               <span class="title">Firebase</span>
               <i class="material-icons secondary-content">mms</i>
        </router-link>
        <router-link to="/chat-room" exact class="collection-item waves-effect waves_colors">
               <span class="title">Chat Room</span>
               <i class="material-icons secondary-content">comment</i>
        </router-link>
        <router-link to="/phone-messenger" exact class="collection-item waves-effect waves_colors">
               <span class="title">Phone Messenger</span>
               <i class="material-icons secondary-content">perm_phone_msg</i>
        </router-link>
        <router-link to="/insert-photo" exact class="collection-item waves-effect waves_colors">
               <span class="title">Insert Photo</span>
               <i class="material-icons secondary-content">camera_enhance</i>
        </router-link>
        <router-link to="/watch-movie" exact class="collection-item waves-effect waves_colors">
               <span class="title">Watch Movie</span>
               <i class="material-icons secondary-content">video_library</i>
        </router-link>
        <router-link to="/listening-music" exact class="collection-item waves-effect waves_colors">
               <span class="title">Listening Music</span>
               <i class="material-icons secondary-content">audiotrack</i>
        </router-link>
        <router-link to="/upload-document" exact class="collection-item waves-effect waves_colors">
               <span class="title">Upload Document</span>
               <i class="material-icons secondary-content">cloud_upload</i>
        </router-link>
</div>
