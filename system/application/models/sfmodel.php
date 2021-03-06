<?php

class SFModel extends Model
    {

    function __construct()
        {
        parent::__construct();

        $this->tableName = SFModel::pluralize(strtolower(get_class($this)));
        $this->primaryKeyName = 'id';
        $this->requiredAttributes = array();
        $this->protectedAttributes = array();
        $this->errors = array();
        }

    function required($fieldname)
        {
        $this->requiredAttributes[] = $fieldname;
        }

    function protectedAttribute($fieldname)
        {
        $this->protectedAttributes[] = $fieldname;
        }

    function applyOptions($options = array())
        {
        if ( isset($options['conditions']) )
            {
            if ( is_array($options['conditions']) )
                {
                foreach ( $options['conditions'] as $fieldName => $value )
                    {
                    $this->db->where($fieldName, $value);
                    }
                }
            else
                {
                $this->db->where($options['conditions']);
                }
            }

        if ( isset($options['limit']) && isset($options['offset']) )
            {
            $this->db->limit($options['limit'], $options['offset']);
            }
        else if ( isset($options['limit']) )
            {
            $this->db->limit($options['limit']);
            }

        if ( isset($options['order']) )
            {
            $this->db->order_by($options['order'][0], $options['order'][1]);
            }
        }

    function where($options = array())
        {
        if ( empty($options) )
            return $this;

        $this->applyOptions(array('conditions' => $options));

        return $this;
        }

    function validate($options = array())
        {
        $valid = true;
        foreach ( $this->requiredAttributes as $requiredFieldName )
            {
            if ( !array_key_exists($requiredFieldName, $options) || empty($options[$requiredFieldName]) )
                {
                $this->errors[] = "A value for field '" . $requiredFieldName . "' must be given.";
                $valid = false;
                }
            }

        return $valid;
        }

    function create($options = array())
        {
        if ( !$this->validate($options) )
            return false;

        $this->db->insert($this->tableName, $options);

        return $this->db->insert_id();
        }

    function update($id = null, $attributes = array())
        {
        if ( empty($attributes) || empty($id) )
            return false;

        foreach ( $this->protectedAttributes as $value )
            {
            unset($attributes[$value]);
            }

        $this->db->where($this->primaryKeyName, $id);
        $this->db->update($this->tableName, $attributes);

        return $this->db->affected_rows();
        }

    function delete($options = array())
        {
        if ( !empty($options) )
            $this->where($options);

        $this->db->delete($this->tableName);
        }

    function find($options = array())
        {
        if ( !empty($options) )
            $this->applyOptions($options);

        $query = $this->db->get($this->tableName);

        return $query->result();
        }

    function findByID($id = 0)
        {
        if ( empty($id) )
            return null;

        $this->db->where($this->primaryKeyName, $id);
        $query = $this->db->get($this->tableName);

        if ( $query->num_rows > 0 )
            return $query->row(0);

        return null;
        }

    function count()
        {
        $this->db->count_all_results($this->tableName);
        }

    function first($iWhere = null)
        {
        $this->where($iWhere);

        $query = $this->db->get($this->tableName, 1, 0);
        if ( $query->num_rows == 0 )
            return null;

        return $query->row();
        }

    function CanFind($iWhere = null)
        {
        $this->where($iWhere);

        $xDude = $this->first();

        return!empty($xDude);
        }

    public static function pluralize($string)
        {

        $plural = array(
        array('/(quiz)$/i', "$1zes"),
        array('/^(ox)$/i', "$1en"),
        array('/([m|l])ouse$/i', "$1ice"),
        array('/(matr|vert|ind)ix|ex$/i', "$1ices"),
        array('/(x|ch|ss|sh)$/i', "$1es"),
        array('/([^aeiouy]|qu)y$/i', "$1ies"),
        array('/([^aeiouy]|qu)ies$/i', "$1y"),
        array('/(hive)$/i', "$1s"),
        array('/(?:([^f])fe|([lr])f)$/i', "$1$2ves"),
        array('/sis$/i', "ses"),
        array('/([ti])um$/i', "$1a"),
        array('/(buffal|tomat)o$/i', "$1oes"),
        array('/(bu)s$/i', "$1ses"),
        array('/(alias|status)$/i', "$1es"),
        array('/(octop|vir)us$/i', "$1i"),
        array('/(ax|test)is$/i', "$1es"),
        array('/s$/i', "s"),
        array('/$/', "s")
        );

        $irregular = array(
        array('move', 'moves'),
        array('sex', 'sexes'),
        array('child', 'children'),
        array('man', 'men'),
        array('person', 'people')
        );

        $uncountable = array(
        'sheep',
        'fish',
        'series',
        'species',
        'money',
        'rice',
        'information',
        'equipment'
        );

        // save some time in the case that singular and plural are the same
        if ( in_array(strtolower($string), $uncountable) )
            return $string;

        // check for irregular singular forms
        foreach ( $irregular as $noun )
            {
            if ( strtolower($string) == $noun[0] )
                return $noun[1];
            }

        // check for matches using regular expressions
        foreach ( $plural as $pattern )
            {
            if ( preg_match($pattern[0], $string) )
                return preg_replace($pattern[0], $pattern[1], $string);
            }

        return $string;
        }

    }
