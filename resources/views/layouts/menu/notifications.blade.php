@if(Auth::check())
<li id="notifications" class="dropdown" data-source="{{ route('api.notifications.index') }}" data-user="{{ auth()->user() }}">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="icon-bubble-dots4"></i>
        <span class="visible-xs-inline-block position-right">{{ trans('app.notifications.title') }}</span>
        <span class="badge bg-warning-400" v-cloak v-if="count > 0">@{{ count }}</span>
        <span class="status-mark border-orange-400" v-cloak v-if="count == 0"></span>
    </a>
    
    <div class="dropdown-menu dropdown-content">
        <div class="dropdown-content-heading">
            {{ trans('app.notifications.title') }}
            <ul class="icons-list">
                <li><a href="#"><i class="icon-sync"></i></a></li>
            </ul>
        </div>

        <ul class="media-list dropdown-content-body width-350">
            <template v-if="notifications.length > 0">
                <li class="media" v-for="notification in notifications">
                    <div class="media-left">
                        <a :href="notification.data.link" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm" @click="read(notification.id)"><i class="icon-bubble-notification"></i></a>
                    </div>

                    <div class="media-body">
                        <span class="media-annotation pull-right">
                            <a href="#" @click="read(notification.id)"><span class="icon-cross text-muted"></span></a>
                        </span>
                        @{{ notification.data.content }}
                        <div class="media-annotation" v-text="notification.created_at_human"></div>
                    </div>
                </li>
            </template>
            <template v-else>
                <li class="media">
                    <div class="media-body">
                        <div class="text-center">{{ trans('app.notifications.empty') }}</div>
                    </div>
                </li>
            </template>
        </ul>
    </div>
</li>
@endif