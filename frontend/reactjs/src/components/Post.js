import React, {useState}    from 'react';
import '../style/Post.css';
import Avatar from '@material-ui/core/Avatar';
import LoginForm from '../pages/LoginForm';

function Post({username, caption, imageUrl}) {
    const [comments, setComments] = useState([{
        username : "Leo",
        text: "testing 4",
    }]);
    const [comment, setComment] = useState(' ');

    const postComment = (event) => {
        //BackEnd 
        //TODO: Take comment and send to database with postID
    }

    return (
        <div className = "post">
            <div className = "post__header">
                <Avatar
                    className = "post__avatar"
                    alt = {username}
                    src = "static/images/avatar/1.jpg"
                />
                <h3>{username}</h3>
            </div>
            <img className="post__image" src ={imageUrl}/>
            <h4 className="post__text"><strong>{username}:</strong> {caption}</h4>
             
             <div className="post__comments">
                 {comments.map((comment) => (
                     <p>
                        <strong> {comment.username}: </strong> {comment.text}
                     </p>
                 ))}</div>
    
            <form className = "post__commentbar">
                <input className = "post__input"
                    type = "text"
                    placeholder = "Add a comment..."
                    value = {comment}
                    onChange= {(e) => setComment(e.target.value)}
                />
                <button className = "post__button"
                disabled = {!comment}
                type = "submit"
                onClick = {postComment}
                > 
                submit
                </button>
            </form>


            <div className ="post__comments">

                
            </div>

        </div>
    )
}

export default Post

