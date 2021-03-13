import { Component } from 'react';
import '../style/Follow.css';

class FollowButton extends Component{
    
    constructor(props){
        super(props);
        this.state = {
            isToggleOn: false
        }
        //binding the handle click
        //this.handleClick = this.handleClick.bind(this);
    }

    handleClick = () =>{
        //Changing the state when clicked 
        this.setState(state => ({
            isToggleOn: !state.isToggleOn
        }));
    }
    

    render(){
        return(
            <div className = "follow__button"> 
                <button onClick ={this.handleClick}>{this.state.isToggleOn? "Following" : "Follow"}</button>

            </div>
        )
    }
}
export default FollowButton 