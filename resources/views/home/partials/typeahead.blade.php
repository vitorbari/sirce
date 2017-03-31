
<script id="result-template-sketches" type="text/x-handlebars-template">
    <div class="ProfileCard u-cf">
        <img class="ProfileCard-avatar" src="@{{picture}}">

        <div class="ProfileCard-details">
            <div class="ProfileCard-realName">@{{title}}</div>
            <div class="ProfileCard-description">Author: @{{name}}</div>
        </div>
    </div>
</script>

<script id="result-template-components" type="text/x-handlebars-template">
    <div class="ProfileCard u-cf">
        <img class="ProfileCard-avatar" src="@{{picture}}">

        <div class="ProfileCard-details">
            <div class="ProfileCard-realName">@{{component}}</div>
            <div class="ProfileCard-description">Sketches: @{{sketches}}</div>
        </div>
    </div>
</script>

<script id="result-template-boards" type="text/x-handlebars-template">
    <div class="ProfileCard u-cf">
        <img class="ProfileCard-avatar" src="@{{picture}}">

        <div class="ProfileCard-details">
            <div class="ProfileCard-realName">@{{board}}</div>
            <div class="ProfileCard-description">@{{manufacturer}}</div>
        </div>
    </div>
</script>

<script id="result-template-mcus" type="text/x-handlebars-template">
    <div class="ProfileCard u-cf">
        <img class="ProfileCard-avatar" src="@{{picture}}">

        <div class="ProfileCard-details">
            <div class="ProfileCard-realName">@{{mcu}}</div>
            <div class="ProfileCard-description">@{{manufacturer}}</div>
        </div>
    </div>
</script>

<script id="result-template-users" type="text/x-handlebars-template">
    <div class="ProfileCard u-cf">
        <img class="ProfileCard-avatar" src="@{{avatar}}">

        <div class="ProfileCard-details">
            <div class="ProfileCard-realName">@{{name}}</div>
            <div class="ProfileCard-description">
                @{{#if location}}
                    @{{location}} |
                @{{/if}}
                @{{references}} sketche(s)
            </div>
        </div>
    </div>
</script>

<script id="empty-template-sketches" type="text/x-handlebars-template">
    <div class="EmptyMessage">Your search turned up 0 results for sketches.</div>
</script>

<script id="empty-template-components" type="text/x-handlebars-template">
    <div class="EmptyMessage">Your search turned up 0 results for components.</div>
</script>

<script id="empty-template-boards" type="text/x-handlebars-template">
    <div class="EmptyMessage">Your search turned up 0 results for boards.</div>
</script>

<script id="empty-template-mcus" type="text/x-handlebars-template">
    <div class="EmptyMessage">Your search turned up 0 results for MCUs.</div>
</script>

<script id="empty-template-users" type="text/x-handlebars-template">
    <div class="EmptyMessage">Your search turned up 0 results for users.</div>
</script>