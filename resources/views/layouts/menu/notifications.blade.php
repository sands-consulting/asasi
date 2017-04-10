@if(Auth::check())
<li id="notifications" class="dropdown" data-source="{{ route('api.notifications.index') }}">
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
                        <a :href="notification.link" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm" v-on:click="read(notification.id)"><i class="icon-user-plus"></i></a>
                    </div>

                    <div class="media-body">
                        @{{ notification.content }}
                        <div class="media-annotation" v-text="notification.created_at_human "></div>
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

        <div class="dropdown-content-footer">
            <a href="{{ route('notifications.index') }}" data-popup="tooltip" title="{{ trans('app.notifications.view') }}"><i class="icon-menu display-block"></i></a>
        </div>
    </div>
</li>
@endif