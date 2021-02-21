import React, { useState } from 'react'
import Modal from '../Modal'
import '../style/Upload.css';
import Button from '@material-ui/core/Button';

export default function Upload({username}) {
    const [caption, setCaption] = useState('');
    const [progress, setProgress] = useState(0);
    const [image, setImage] = useState(null);

    const handleChange = (e) =>{
        if(e.target.file[0]){
            setImage(e.target.files[0]);
        }
    }

    const handleUpload = () => {
        /*#TODO: take the image that you uploaded and store in database*/
        //#TODO: bottom code to be uncommented after adding the code to store the image
        //const uploadTask = [How we would store the data into a database]
        /* uploadTask.on(
            "state_changed",
            (snapshot) => {
            const progress = Math.round(
                (snapshot.bytesTransferred / snapshot.totalBytes ) * 100
            );
            setProgress (progress);
            },
            (error) => {
                console.log(error);
                alert(error.message);
            },
            () =>{
                storage
                .ref("images")
                .child(image.name)
                .getDownloadURL()
                .then(url =>{
                    db.collection("posts").add({
                        timestamp: //TODO: grab server timestamp,
                        caption: caption,
                        imageUrl: url,
                        username: username
                    })
                })
            }
        ) */
    }
  const [isOpen, setIsOpen] = useState(false)
  return (
    <>
      <div className ="upload__button" onClick={() => console.log('clicked')}>
        <button onClick={() => setIsOpen(true)}>Upload</button>

        <Modal open={isOpen} onClose={() => setIsOpen(false)}>
            <div className = "upload__post">
                <form action="">
                    <div className ="caption">
                        <label for="caption">Enter the caption</label>
                        <input type="text" placeholder='Enter a caption...' onChange={event => setCaption(event.target.value)} value={caption}/>
                        <input type="file" onChange={handleChange}/>
                    </div>
                    <input type="button" value="Upload" id = "cta-btn" onClick ={handleUpload}></input>
                    <div className = "upload__image">
                        
                        {/* <Button onClick ={handleUpload}>
                         Upload
                        </Button> */}
                    </div>
                    
                </form>
            </div>
        </Modal>
      </div>

    </>
  )
}
