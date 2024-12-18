<?php

namespace BalajiDharma\LaravelAttributes\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Attributable
{
    use HasRelationships;

    /**
     * Get attributes.
     *
     * @return MorphMany
     */
    public function attributes()
    {
        return $this->morphMany(
            config('attributes.models.attributes'),
            'attributable',
            'attributable'
        );
    }

    /**
     * Attach attribute.
     *
     * @return Builder|Model
     */
    public function attachAttribute(string $name, string $value, ?string $data_type = 'string', ?int $weight = 0) 
    {
        $attributes = [
            'data_type' => $data_type,
            'name'  => $name,
            'value' => $value,
            'attributable_id' => $this->getKey(),
            'attributable'  => $this->getMorphClass(),
            'weight' => $weight,
        ];

        return $this->attributes()->create($attributes);
    }

    /**
     * Attach multiple attributes.
     *
     * @return $this
     */
    public function attachAttributes(array $values)
    {
        $weight = 1;
        foreach ($values as $value) {
            $value['attributable_id'] = $this->getKey();
            $value['attributable'] = $this->getMorphClass();
            $value['weight'] = $value['weight'] ?? $weight;
            $this->attributes()->create($value);
            $weight++;
        }

        return $this;
    }

    /**
     * Check attribute have special value.
     *
     * @return bool
     */
    public function hasAttributeValue(string $value)
    {
        return $this->getAttributeWhere()
            ->where('value', $value)
            ->exists();
    }

    /**
     * Check attribute have special name.
     *
     * @return bool
     */
    public function hasAttributeName(string $name)
    {
        return $this->getAttributeWhere()
            ->where('name', $name)
            ->exists();
    }

    /**
     * Delete all attributes.
     *
     * @return Attributable
     */
    public function deleteAllAttribute()
    {
        $attributes = $this->getAttributeWhere()->get();

        foreach ($attributes as $attribute) {
            $attribute->delete();
        }

        return $this;
    }

    /**
     * Delete special attribute.
     *
     * @return int
     */
    public function deleteAttribute(string $name, string $value)
    {
        return $this->getAttributeWhere()
            ->where('name', $name)
            ->where('value', $value)
            ->delete();
    }

    /**
     * Delete attribute by name.
     *
     * @return int
     */
    public function deleteAttributeByName(string $name)
    {
        return $this->getAttributeWhere()
            ->where('name', $name)
            ->delete();
    }

    /**
     * Delete attribute by value.
     *
     * @return int
     */
    public function deleteAttributeByValue(string $value)
    {
        return $this->getAttributeWhere()
            ->where('value', $value)
            ->delete();
    }

    /**
     * Get attribute with this (model).
     */
    private function getAttributeWhere(): MorphMany
    {
        return $this->attributes()
            ->where('attributable_id', $this->getKey())
            ->where('attributable', $this->getMorphClass());
    }
}