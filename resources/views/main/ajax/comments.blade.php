@foreach($comments as $comment)
<div class="comment-div">
    <table border="0px">
        <tr>
            <td width="10%">
                <div class="comments-profile-div">
                    {{$comment->user->name}}
                    <img src="/images/profile.png" class="comments-profile-image">
                </div>           
            </td>
            <td align="left" valign="top"  width="80%">
                <div class="comments-content-div">
                    {{$comment->commentText}}
                </div>
            </td>
            <td  width="10%" valign="top" class="comments-date-div">   
                Коментар було додано<br>
                {{$comment->created_at}}
            </td>
        </tr>
    </table>
</div>
@endforeach