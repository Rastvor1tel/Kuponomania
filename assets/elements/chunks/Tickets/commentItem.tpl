<li class="ticket-comment[[+comment_new]]" id="comment-[[+id]]" data-parent="[[+parent]]"
    data-newparent="[[+new_parent]]" data-id="[[+id]]">
    <div class="ticket-comment-body[[+guest]][[+bad]]">
        <div class="ticket-comment-header">
            <div class="ticket-comment-dot-wrapper">
                <div class="ticket-comment-dot"></div>
            </div>
            <img src="[[+avatar]]" class="ticket-avatar" alt=""/>
            <span class="ticket-comment-author">[[+fullname]]</span>
            <span class="ticket-comment-createdon">[[+date_ago]]</span>
        </div>
        <div class="ticket-comment-text">
            [[+text]]
        </div>
    </div>
    {if ($_modx->hasSessionContext('mgr'))}
    <div class="comment-reply">
        <a href="#" class="reply">[[%ticket_comment_reply]]</a>
        [[+comment_edit_link]]
    </div>
    {/if}
    <ol class="comments-list">[[+children]]</ol>
</li>