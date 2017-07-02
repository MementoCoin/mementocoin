import React from 'react'
import { Field, FieldArray } from 'redux-form'
import { Panel, Well, Button, Form, FormGroup, FormControl, Row, Col, ControlLabel, ProgressBar } from 'react-bootstrap'
import './Benefits.scss'

const CustomInput = (props) => {
  return (
    <FormGroup style={{textAlign: 'left'}}>
      <ControlLabel>{props.label}</ControlLabel>
      <FormControl
        value={props.input.value}
        onChange={props.input.onChange}
        placeholder={props.placeholder} />
    </FormGroup>
  )
}

const BenefitsArray = ({ fields }) => (
  <div>
    {fields.map((receiver, index) =>
      <Row key={index}>
        <Col md={12}>
          <Form>
            <Col md={3} mdOffset={1}>
              <Field
                name={`${receiver}.pocketID`}
                type="text"
                component={CustomInput}
                label="Who"
                placeholder='Ethirium pocket ID' />
            </Col>
            <Col md={3}>
              <Field
                name={`${receiver}.contacts`}
                type="text"
                component={CustomInput}
                label='Contacts'
                placeholder='Email' />
            </Col>
            <Col md={2}>
              <Field
                name={`${receiver}.part`}
                type="text"
                component={CustomInput}
                label='Part to send'
                placeholder='Percentage' />
            </Col>
            <Col md={1}>
              <Button className='add-receiver-btn' onClick={() => fields.remove(index)} bsSize='large' bsStyle="danger">Remove</Button>
            </Col>
          </Form>
        </Col>
      </Row>
    )}
    { (!fields || fields.length < 5) &&
      <Row>
        <Col md={12}>
          <Button onClick={() => fields.push({})} bsSize='large' bsStyle="success">Add</Button>
        </Col>
      </Row>
    }
  </div>
)

const Benefits = (props) => {
  const colors = ['#439d7d', '#5d879d', '#7771be', '#915bde', '#ab45ff']
  return (
    <Panel header={<h1>Add inheritors!</h1>}>
    <Well style={{backgroundColor: '#ffffff'}}>
      <Row>
        { (props.benefitsArray && props.benefitsArray.length > 0) &&
          <Col md={10} mdOffset={1}>
            <ControlLabel>
              {`You distributed ${props.benefitsArray.reduce( (sum, current) => 
              current.part ? sum + +current.part : sum, 0)}% of coins`}
            </ControlLabel>
            <ProgressBar className='ProgressBar'>
              { props.benefitsArray.map((receiver, index) =>
                <ProgressBar
                  style={{backgroundColor: colors[index]}}
                  key={index}
                  now={receiver.part ? receiver.part : 0} />
              )}
            </ProgressBar>
          </Col>
        }
      </Row>
      <FieldArray
        name="benefitsArray"
        component={BenefitsArray} />
    </Well>
      
        <Col md={12}>
          <Button onClick={props.onClick} bsSize='large' bsStyle="success">Continue</Button>
        </Col>
    </Panel>
  )
}

export default Benefits
