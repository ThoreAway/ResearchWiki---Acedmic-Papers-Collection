import React from "react";
import Paper from "./Paper";
import CheckBox from "./CheckBox";

/**
 * ReadingList component to generate a list of papers that can be marked for reading later and stored with a user id
 *  
 * Uses the papers and readinglist endpoint to define the readinglist and results states before calling the checkbox and paper 
 * component in its return method. The checkbox uses readinglist state and the paper_Id's from the users readinglist to know which 
 * checkboxes need to have their state set to true. Also checks for errors returned by the readinglist api to know when the jwt has    
 * expired and forcres a refresh along with clearing the local storge if an internal error is caught.
 * 
 * Aditionally features page selection to allow the user to cycle through the paper list, however, the checkbox state is not 
 * remembered between pages thefore ones you have previiously marked are unmarked when you go back through pages. Refreshing allows 
 * for the states to update but the states should be remembered between pages.
 * 
 * @todo fix checkbox state bug
 * 
 * @author Jacob Clark w18003237
*/

class ReadingList extends React.Component {

    constructor(props) {
        super(props)
        this.state = {
            readinglist: [],
            results: []
        }
    }

    componentDidMount() {
        let pUrl = "http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/papers"

        fetch(pUrl)
            .then((response) => {
                if (response.status === 200) {
                    return response.json()
                } else {
                    throw Error(response.statusText);
                }
            })
            .then((data) => {
                this.setState({ results: data.results })
                console.log(data)
            })
            .catch((err) => {
                console.log("something went wrong ", err)
            });

       let rUrl = "http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist"

        let formData = new FormData();
        formData.append('token', this.props.token);


        fetch(rUrl, {
            method: 'POST',
            headers: new Headers(),
            body: formData
        })
            .then((response) => {
                if (response.status === 200) {
                    return response.json()
                } else {
                    throw Error(response.statusText);
                }
            })
            .then((data) => {
                this.setState({ readinglist: data.results })
            })
            .catch((err) => {
                console.log("something went wrong ", err) 

                localStorage.clear();
                window.location.replace("/readinglist");
               
            });
    }

    render() {
        let buttons = "";
        let fResults = this.state.results
        const pageSize = 10
        let pageNumber = this.props.page
        let pageM = Math.round(fResults.length / pageSize)
        let pageCounter = <p>Page {pageNumber} out of {pageM}</p>

        if (pageNumber === undefined) {
            pageCounter = ""
        }

        if (this.props.page !== undefined) {
            const pageSize = 10
            let pageMax = this.props.page * pageSize
            let pageMin = pageMax - pageSize


            buttons = (
                <div>
                    <button onClick={this.props.handlePreviousClick} disabled={this.props.page <= 1}>Previous</button>
                    <button onClick={this.props.handleNextClick} disabled={this.props.page >= Math.ceil(fResults.length / pageSize)}>Next</button>
                </div>
            )
            fResults = fResults.slice(pageMin, pageMax)

        }

        return (
            <div>
                <form>
                    {fResults.map((paper) => (
                        <label key={paper.PaperId}>
                            <CheckBox readinglist={this.state.readinglist} paper_id={paper.PaperId} />
                            <Paper paper={paper} />
                        </label>
                    )
                    )}
                </form>
                <div>
                    {buttons}
                    {pageCounter}
                </div>
            </div>
        )
    }
}

export default ReadingList;
