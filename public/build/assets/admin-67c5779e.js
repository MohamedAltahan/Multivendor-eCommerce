function a(t){const i={year:"numeric",month:"short",day:"2-digit",hour:"2-digit",minute:"2-digit"};return new Intl.DateTimeFormat("en-Us",i).format(new Date(t))}function s(){mainChatInbox.scrollTop(mainChatInbox.prop("scrollHeight"))}window.Echo.private("message."+USER.id).listen("MessageEvent",t=>{let i=$(".chat-content");if(i.attr("data-inbox")==t.sender_id)var e=`
                <div class="chat-item chat-left" style=""><img
                style="height: 50px;
                                 "
                src="${t.sender_image}"><div class="chat-details"><div class="chat-text">${t.message}</div><div class="chat-time">${a(t.date_time)}</div></div></div>
            `;i.append(e),s(),$(".chat-user-profile").each(function(){$(this).data("id")==t.sender_id&&$(this).find("img").addClass("msg-notification")})});
