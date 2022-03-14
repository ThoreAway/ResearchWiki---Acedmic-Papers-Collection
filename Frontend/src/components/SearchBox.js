import React from "react";

/**
 * A simple searchbox used to receive a text input that can be used as a search term
 * 
 * The inputed text is given the value of this.props.search and a search function is called each time the input box
 * is changed 
 *
 * @author Jacob Clark w18003237
*/
   
class SearchBox extends React.Component {

    render() {
           return (
               <label>
                   <input type='text' placeholder='search' value={this.props.search} onChange={this.props.handleSearch} />
               </label>
           )
       }
   }
   
export default SearchBox;