import React from "react";
import Author from './Author.js';

/**
 * Author component to display the list of authours from the authors endpoint
 *  
 * Fetches the list of authors from the api using the author component as each individual author in the list and then places them in 
 * this.state.results to be displyed in the render method. 
 * 
 * A filter search method is defined that uses the .inlcudes method to search through the authors being returned using the .filter 
 * method. The search method use the SearchBox component to take input accepting all of the authors name.
 * 
 * Aditionally features page selection to allow the user to cycle through the authours list with a page number counter displayed as well.
 * 
 * @author Jacob Clark w18003237
*/

class Authors extends React.Component {

    constructor(props){
        super(props)
        this.state = { results : [] }
    }

    componentDidMount() {
        let url = "http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/authors"

        if (this.props.paperid !== undefined){
            url += "?paperid=" + this.props.paperid
       }
    
        fetch(url)
          .then( (response) => {
              if (response.status === 200) {
                return response.json() 
              } else {
                throw Error(response.statusText);
              }
          })
          .then( (data) => {
            this.setState({results:data.results})
          })
          .catch ((err) => { 
            console.log("something went wrong ", err) 
          });
    }

    filterSearch = (s) => {
        let searchKey = s.FirstName && s.LastName;
        let searchResults = searchKey.toLowerCase().includes(this.props.search.toLowerCase())

        return searchResults
    }
    

    render() {
        let noData = ""
        if(this.state.results.length === 0 ){
            noData =  "There is no data to be displayed"
        }

        let filteredResults = this.state.results

        if ((filteredResults.length > 0) && (this.props.search !== undefined)) {
            filteredResults = this.state.results.filter(this.filterSearch)
        }

        let buttons = "";  
        const pageSize = 20
        let pageNumber = this.props.page
        let pageM = Math.ceil(filteredResults.length / pageSize)
        let pageCounter = <p>Page {pageNumber} out of {pageM}</p>

        if(pageNumber === undefined){
            pageCounter = ""
        }

        if (this.props.page !== undefined) {
            const pageSize = 20
            let pageMax = this.props.page * pageSize
            let pageMin = pageMax - pageSize
            

            buttons = (
                <div>
                    <button onClick={this.props.handlePreviousClick} disabled={this.props.page <= 1}>Previous</button>
                    <button onClick={this.props.handleNextClick} disabled={this.props.page >= Math.ceil(filteredResults.length / pageSize)}>Next</button>
                </div>
            )
            filteredResults = filteredResults.slice(pageMin,pageMax)
            
        }

        return (
            <div>
                {noData}
                {filteredResults.map( (author, i) => (<Author key={author.AuthorId} author={author}/>) )}
                <div>
                    {buttons} 
                    {pageCounter}
                </div>
            </div>
        )
    }
}

export default Authors;