import React, {useState}    from 'react';
import '../style/UserPage.css';
import '../style/App.css';
import Post	                from '../components/Post';
import Profile              from '../components/Profile';
import fakestagram          from '../image/fakestagram_logo.jpg'
import Upload from'../components/Upload'

function UserPage() {

    /*Setting up State (hooks) */
    const [posts, setPosts] = useState([
        {
            username: "Jun", 
            caption: "testing 1", 
            imageUrl: "https://www.andreasreiterer.at/wp-content/uploads/2017/11/react-logo-825x510.jpg.webp"
        },
        {
            username: "Kelvin", 
            caption: "testing 2", 
            imageUrl: "https://www.andreasreiterer.at/wp-content/uploads/2017/11/react-logo-825x510.jpg.webp"
        },
        {
            username: "YuShan", 
            caption: "testing 3", 
            imageUrl: "https://www.andreasreiterer.at/wp-content/uploads/2017/11/react-logo-825x510.jpg.webp"
        }
    ]);

    return (
        <div className="userpage">
            <div className="userpage__header">
{/*                 <img
                    className ="userpage__headerImage" 
                    src = "https://www.transparentpng.com/thumb/logo-instagram/EvWlA1-logo-instagram-transparent-picture.png"
                 /> */}
                <div className="userpage__logo">
                    <a href= "/">Fakestagram</a>    
                </div>
                <Upload/>
                <a href= "/Login">Log Out</a>    
            </div>
            <div className = "userpage__profile">
                <Profile profilename = "Main profile" profilequote = "Electrical Engineering: Peace be amplified, world be rectified. Electrical Engineers: No resistance can drop our potential. Electrical Engineers: We step up, We Transform. Ere long intelligence—transmitted without wires—will throb through the earth like a pulse through a living organism." />
            </div>
            <div className = "userpage__post">
            {   
                /* Run through the array to show post */
                posts.map(post => (
                   <Post username = {post.username} caption = {post.caption} imageUrl = {post.imageUrl} />
                ))

            }
            </div>
        </div>
        
     );
}
export default UserPage;
