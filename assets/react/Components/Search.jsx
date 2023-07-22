import React, { useState, useEffect } from 'react';
import { API_URL } from '../config';

const Search = () => {
  const [searchTerm, setSearchTerm] = useState('');
  const [suggestions, setSuggestions] = useState([]);
 

  useEffect(() => {
    if (searchTerm) {
      fetchSuggestions();
    } else {
      setSuggestions([]);
    }
  }, [searchTerm]);

  const fetchSuggestions = async () => {
    try {
      const response = await fetch(`${API_URL}/api/tyre/search?term=${searchTerm}`);
      const data = await response.json();
      
      setSuggestions(data);
      console.log(suggestions[0]);
    } catch (error) {
        console.log('Response:', error.response);
      console.error('Error fetching suggestions:', error);
    }
  };

// handle suggestions visibility on search 

  const isInputEmpty = searchTerm === '';
  const ulClassName = isInputEmpty ? 'invisible' : '';

// handle link to route 
const handleSuggestionClick = (suggestion) => {
  const dimensions = suggestion[Object.keys(suggestion)].replace(/\//g, "");
  window.location.href = `api/results/${dimensions}`;
};


  return (
    <div class='mb-8 mt-64 flex flex-col items-center font-sans'>
      <input class='w-1/2 text-7xl mx p-5 rounded-full text-center  tracking-wide border-4  '
        type="text"
        value={searchTerm}
        onChange={(e) => setSearchTerm(e.target.value)}
        placeholder="Search..."    
      />
      <ul className={`${ulClassName} w-1/3  rounded-md`}>
        {suggestions.map((suggestion, index) => (
          <li
            className="p-6 text-4xl hover:bg-sky-200"
            key={index}
            onClick={() => handleSuggestionClick(suggestion)}
          >
            {Object.entries(suggestion).map(([key, value]) => (
              <span key={key}>
                {key}: {value}
              </span>
            ))}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default Search;
