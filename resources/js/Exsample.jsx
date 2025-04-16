import React from 'react';
import ReactDOM from 'react-dom';

const Example = () => {
    return <h1>Hello, React di Laravel!</h1>;
};

export default Example;

if (document.getElementById('app')) {
    ReactDOM.render(<Example />, document.getElementById('app'));
}
