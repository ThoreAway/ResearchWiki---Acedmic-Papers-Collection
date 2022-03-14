import React from "react";

/**
 * CheckBox component used to create checkbox input boxes
 * 
 * Uses the readinglist to set the state of the checkboxes based on what a user has in their readinglist within componentDidMount. 
 * This is done using the isOnList function it identify the id's on the list
 * 
 * Features two seperate methods to add and remove records to the readinglist table using the readinglist endpoint. A handleOnChange  
 * function is defined to add when the checkbox state is checked or remove when not checked.
 * 
 * Also checks for errors returned by the readinglist api when adding or removing to the list to know when the jwt has    
 * expired and force a refresh along with clearing the local storge if an internal error is caught.
 * 
 * @author Jacob Clark w18003237
*/

class CheckBox extends React.Component {

    constructor(props) {
        super(props);
        this.state = { checked: false }
    }

    componentDidMount() {
        let filteredList = this.props.readinglist.filter((item) => (this.isOnList(item)))
        if (filteredList.length > 0) {
            this.setState({ checked: true })
        }
    }

    isOnList = (item) => {
        return (item.paper_id === this.props.paper_id)
    }

    addToReadingList = () => {
        let url = "http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist"

        let formData = new FormData();
        formData.append('token', localStorage.getItem('myReadingListToken'));
        formData.append('add', this.props.paper_id);

        fetch(url, {
            method: 'POST',
            headers: new Headers(),
            body: formData
        })
            .then((response) => {
                if ((response.status === 200) || (response.status === 204)) {
                    this.setState({ checked: true })
                } else {
                    throw Error(response.statusText);
                }
            })
            .catch((err) => {
                console.log("something went wrong ", err)

                localStorage.clear();
                window.location.replace("/readinglist");
            });
    }

    removeFromReadingList = () => {
        let url = "http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist"

        let formData = new FormData();
        formData.append('token', localStorage.getItem('myReadingListToken'));
        formData.append('remove', this.props.paper_id);

        fetch(url, {
            method: 'POST',
            headers: new Headers(),
            body: formData
        })
            .then((response) => {
                if ((response.status === 200) || (response.status === 204)) {
                    this.setState({ checked: false })
                } else {
                    throw Error(response.statusText);
                }
            })
            .catch((err) => {
                console.log("something went wrong ", err)

                localStorage.clear();
                window.location.replace("/readinglist");
            });
    }

    handleOnChange = () => {
        if (this.state.checked) {
            this.removeFromReadingList()
        } else {
            this.addToReadingList()
        }
    }

    render() {
        return (
            <input
                type="checkbox"
                id="readlist"
                name="readlist"
                value="paper"
                checked={this.state.checked}
                onChange={this.handleOnChange}
            />
        )
    }
}

export default CheckBox;
