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
        let btn_class = this.state.isToggleOn ? "following__button": "follow__button ";

        return(
            <div className = {btn_class}>
                <button 
                    onClick ={this.handleClick}>
                        {this.state.isToggleOn? "Following" : "Follow"}
                </button>
            </div>
        )
    }
}
export default FollowButton 