    import React from 'react'
    import '../style/Profile.css';
    import Avatar from '@material-ui/core/Avatar';


    function Profile({profilename, profilequote,}) {
        return (
            <div className = "profile">
                <div className = "profile__header">
                <Avatar
                    className = "post__avatar"
                    alt = {profilename}
                    src = "static/images/avatar/1.jpg"
                />
                    <h3>{profilename}</h3>
                </div>
                <h4 className = "profile__quote">
                    {profilequote}
                </h4>
            </div>
        )
    }
    
    export default Profile
    
