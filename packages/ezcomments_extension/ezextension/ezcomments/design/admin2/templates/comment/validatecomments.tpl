<div class="context-block">
    <div class="box-header">
        <h1 class="context-title">{'Confirm comments validation'|i18n( 'ezcomments/comment/validatecomments' )}</h1>
        <div class="header-mainline"></div>
    </div>

    <div class="box-content">
        <div class="message-confirmation">
            <h2>{'Are you sure you want to validate selected comments?'|i18n( 'ezcomments/comment/validatecomments' )}</h2>
        </div>
    </div>

    <div class="controlbar">
        <div class="block">
            <form action={'comment/validatecomments'|ezurl} method="post" name="CommentRemove">
                <input class="defaultbutton" type="submit" name="ConfirmButton" value="{'OK'|i18n( 'ezcomments/comment/validatecomments' )}" />
                <input class="button" type="submit" name="CancelButton" value="{'Cancel'|i18n( 'ezcomments/comment/validatecomments' )}" />
            </form>
        </div>
    </div>
</div>