import React from 'react'
import { Jumbotron, Panel, Button, Form, FormGroup, FormControl, Col, Checkbox, ControlLabel } from 'react-bootstrap'
import { Field } from 'redux-form'


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

const Dates = (props) => (
  <Panel header={<h1>Notification</h1>}>
    <Form style={{ margin: "0 auto" }} horizontal>
      <Field
        name="timeperiod"
        type="text"
        placeholder="Time period"
        component={FieldInput}
      />
      <Field
        name='timeaccept'
        type="text"
        placeholder="Time accept"
        component={FieldInput}
      />

      <FormGroup>
        <Col smOffset={2} sm={1} style={{ textAlign: "left" }}>
          <Button bsStyle="success" onClick={props.onSubmit}>
            Submit
          </Button>
        </Col>
      </FormGroup>
    </Form>
  </Panel >
)

export default Dates
