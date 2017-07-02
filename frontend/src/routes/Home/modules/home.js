

export const SHOW_REGISTRATION = 'SHOW_REGISTRATION'

// ------------------------------------
// Actions
// ------------------------------------
export const showRegistration = () => ({
  type: SHOW_REGISTRATION
})

export const sendData = (data) => {
  console.log(data)
  return (dispatch, getState) =>
    fetch('http://cbreality.azurewebsites.net/add', { method: 'POST', mode: 'cors', credentials: 'include', cache: 'no-cache' })
      .then(res => res.json())
      .then(data => console.log(data))
      .catch(err => console.log(err))
}

/*  This is a thunk, meaning it is a function that immediately
    returns a function for lazy evaluation. It is incredibly useful for
    creating async actions, especially when combined with redux-thunk! */


export const actions = {
  showRegistration
}

// ------------------------------------
// Action Handlers
// ------------------------------------
const ACTION_HANDLERS = {
  [SHOW_REGISTRATION]: (state, action) => ({ ...state, isSignIn: !state.isSignIn })
}

const initialState = {
  isRememberMe: false,
  isSignIn: false
}

export default function homeReducer(state = initialState, action) {
  const handler = ACTION_HANDLERS[action.type]

  return handler ? handler(state, action) : state
}
