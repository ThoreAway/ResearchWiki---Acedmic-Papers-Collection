import React from "react";
import Paper from './Paper.js';

/**
 * Paper component to display the list of papers from the papers endpoint
 *  
 * Fetches the list of papers from the api using the paper component as each individual paper in the list and then places them in this.
 * state.results to be displyed in the render method. 
 * 
 * Two filter methods included that use the parameters that can be passed to 
 * the api to filter the papers being returned using the .filter method. The filter methods use the SearchBox and SelectAwarded 
 * components to take input and both can be used at the same time.
 * 
 * Aditionally features page selection to allow the user to cycle through the paper list with a page number counter displayed as well.
 * 
 * @author Jacob Clark w18003237
*/

class Papers extends React.Component {

    constructor(props){
        super(props)
        this.state = { results : [] }
    }

    componentDidMount() {
        let url = "http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/papers" 
        
       if (this.props.authorid !== undefined){
            url += "?authorid=" + this.props.authorid
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
              if (this.props.randomPaper){
             const randomPaperId = Math.floor(Math.random() * data.results.length);
             this.setState({results:[data.results[randomPaperId]]})
              }else{
                  this.setState({results:data.results})
              }
          })
          .catch ((err) => { 
            console.log("something went wrong ", err) 
          });
    }

    filterByAward = (paper) => {
        let awardResponse
        if(this.props.award === "all"){
            awardResponse = paper.award 
        }

        if(this.props.award === "none"){
            awardResponse = (paper.award === null)
        }

        return (awardResponse || (this.props.award === "" ))
    }

    filterSearch = (s) => {
        let searchKey = s.title && s.abstract;
        let searchResults = searchKey.toLowerCase().includes(this.props.search.toLowerCase())

        return searchResults
    }
    

    render() {
        let noData = ""
        if(this.state.results.length === 0 ){
            noData = "There is no data to be displayed"
        }

        let filteredResults = this.state.results

        if ((filteredResults.length > 0) && (this.props.search !== undefined)) {
            filteredResults = this.state.results.filter(this.filterSearch)
        }

        if(this.props.award){
            filteredResults = this.state.results.filter(this.filterByAward)
        }

        if((this.props.award) && (this.props.search !== undefined)){
            filteredResults = this.state.results.filter(this.filterSearch);
            filteredResults = filteredResults.filter(this.filterByAward);
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
                {filteredResults.map( (paper) => (<Paper key={paper.PaperId} paper={paper}/>) )}
                <div>
                    {buttons} 
                    {pageCounter}
                </div>
            </div>
        )
    }
}

export default Papers;