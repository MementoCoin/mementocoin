import React from 'react'
import { Jumbotron, Panel, Button, Form, FormGroup, FormControl, Col, Checkbox, ControlLabel } from 'react-bootstrap'
import { Field } from 'redux-form'
import { LogIn, Benefits, Dates, Pocket } from 'components'
import './HomeView.scss'

const FieldInput = ({ label, type, placeholder, input }) => (
  <FormGroup>
    <Col componentClass={ControlLabel} sm={2}>
      {label ? label : placeholder}
    </Col>
    <Col sm={10}>
      <FormControl
        type={type}
        placeholder={placeholder}
        value={input.value}
        onChange={input.onChange} />
    </Col>
  </FormGroup>
)

const CheckboxInput = (props) => (
  <FormGroup>
    <Col smOffset={2} sm={2} style={{ textAlign: "left" }}>
      <Checkbox
        value={props.input.value}
        onChange={props.input.onChange} >
        Label
      </Checkbox>
    </Col>
    <Col sm={2}>
      <div style={{ textAlign: "left", paddingTop: "7px" }}>
        <a href="/"> Forgot password</a>
      </div>
    </Col>
  </FormGroup>
)

class HomeView extends React.Component {
  constructor (props) {
    super(props)
    this.nextPage = this.nextPage.bind(this)
    this.previousPage = this.previousPage.bind(this)
    this.submitForm = this.submitForm.bind(this)
    this.state = {
      page: 1
    }
  }
  nextPage () {
    this.setState({ page: this.state.page + 1 })
  }

  previousPage () {
    this.setState({ page: this.state.page - 1 })
  }

  submitForm() {
    console.log('submitting...')
    const {name, password, benefits, timeperiod, timeaccept } = this.props
    const wallet = ''
    const email = 'kgolovkin@mail.ru'
    this.props.sendData( {name, password, wallet, email, benefits, timeperiod, timeaccept })
    this.nextPage()
  }

  render () {
    const {name, password, benefits, timeperiod, timeaccept } = this.props
    //console.log(name, password, benefits, timeperiod, timeaccept)
    const { onSubmit } = this.props
    const { page } = this.state
    return (
      <div>
        {page === 1 && <LogIn showRegistration={this.props.showRegistration} isSignIn={this.props.isSignIn} onClick={this.nextPage} />}
        {page === 2 &&
          <Benefits
            benefitsArray={benefits}
            previousPage={this.previousPage}
            onClick={this.nextPage}
          />}
        {page === 3 &&
          <Dates
            previousPage={this.previousPage}
            onSubmit={this.submitForm}
          />}
        {page === 4 &&
          <Pocket /> }
      </div>
    )
  }
}

export default HomeView
