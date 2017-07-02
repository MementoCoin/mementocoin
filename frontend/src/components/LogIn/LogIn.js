import React from 'react'
import { Panel, Button, Form, FormGroup, FormControl, Col, Checkbox, ControlLabel } from 'react-bootstrap'
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


export const LogIn = (props) => {
  return (
    <Panel header={<h1>Log In</h1>}>
      <Form style={{ margin: "0 auto" }} horizontal>
        <Field
          name="login"
          type="text"
          placeholder="Login"
          component={FieldInput}
        />
        <Field
          name='password'
          type="password"
          placeholder="Password"
          component={FieldInput}
        />
        {props.isSignIn &&
          <Field
            name='repPassword'
            type="password"
            placeholder="Repeat password"
            component={FieldInput}
          />}
        {props.isSignIn &&
          <Field
            name='email'
            type="email"
            placeholder="Email"
            component={FieldInput}
          />
        }


        {!props.isSignIn &&
          <FormGroup>
            <Col smOffset={2} sm={2} style={{ textAlign: "left" }}>
              <Checkbox>Remember me</Checkbox>
            </Col>
            <Col sm={2}>
              <div style={{ textAlign: "left", paddingTop: "7px" }}>
                <a href="/"> Forgot password</a>
              </div>
            </Col>
          </FormGroup>

        }

        <FormGroup>
          <Col smOffset={2} sm={1} style={{ textAlign: "left" }}>
            <Button bsStyle="success" onClick={() => props.onClick()}>
              Log In
            </Button>
          </Col>
          <Col sm={1}>
            <Button bsStyle="info" onClick={props.showRegistration}>
              Sign In
          </Button>
          </Col>

        </FormGroup>
      </Form>
    </Panel >
  )
}

export default LogIn
